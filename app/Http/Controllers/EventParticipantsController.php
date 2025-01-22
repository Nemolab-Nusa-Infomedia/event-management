<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Events;
use App\Models\Participants;
use Illuminate\Http\Request;
use App\Mail\CertificateMailable;
use App\Models\EventParticipants;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MailSenderController;
use App\Http\Requests\StoreEventParticipantsRequest;
use App\Http\Requests\UpdateEventParticipantsRequest;

class EventParticipantsController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $participants = EventParticipants::with(['user', 'event'])->get();
        } else {
            $participants = EventParticipants::with(['user', 'event'])
                ->whereHas('event', function ($query) {
                    $query->where('id_master', Auth::id());
                })
                ->get();
        }
        return view('admin.eventParticipan', compact('participants'));
    }

    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $events = Events::all();
        } else {
            $events = Events::where('id_master', Auth::id())->get();
        }
        return view('participants.create', compact('events'));
    }

    public function store(Request $request)
    {
        $event = Events::findOrFail($request->id_event);
        // return response()->json($request);
        if (!$event) return redirect()->back()->with('fail', 'Cannot add participant');

        // $event = Events::where('id', '=', $request['id_event'])->get();
        $validated = $request->validate([
            'id_event' => ['required', 'exists:events,id'],
            'name' => ['required'],
            'email' => ['required'],
            'no_telp' => ['required'],
            'alamat' => ['required'],
            'for_me' => ['sometimes'],
        ]);

        $validated['id_participant'] = null;

        if (Auth::check() && $request->has('for_me') && $validated['for_me'] == true) {
            $user = User::findOrFail($validated['id_user'])->where('name', '=', $validated['name'])->where('email', '=', $validated['email'])->where('no_telp', '=', $validated['no_telp'])->where('alamat', '=', $validated['alamat'])->where('role', '=', 'user');
        }

        if (!$request->has('for_me')) {
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telp'],
                'alamat' => $validated['alamat'],
            ];

            // $validated['id_user'] = null;
            $participant = Participants::firstOrCreate($data);
            $validated['id_participant'] = $participant['id'];
        }

        $data = [
            'id_user' => $request->id_user,
            'id_participant' => $validated['id_participant'],
            'id_event' => $validated['id_event'],
        ];
        
        $eventParticipant = EventParticipants::firstOrCreate($data);
        // return response()->json([$request, $validated, $eventParticipant]);


        if ($event) {
            MailSenderController::SendNotif($validated, $eventParticipant->id);
            return redirect()->route(Auth::check() ? 'joined' : 'welcome')
                ->with('success', 'Participant added successfully.');
        }

        if (Auth::user()->role !== 'admin' && $event->id_master !== Auth::id()) {
            return redirect()->route('home')
                ->with('success', 'Participant added successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EventParticipants $eventParticipants)
    {
        return view('event.show', compact('eventParticipants'));
    }

    public function edit(EventParticipants $participant)
    {
        // Check if user has permission to edit this participant
        if (Auth::user()->role !== 'admin' && $participant->event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (Auth::user()->role === 'admin') {
            $events = Events::all();
        } else {
            $events = Events::where('id_master', Auth::id())->get();
        }

        return view('participants.edit', compact('participant', 'events'));
    }

    public function update(Request $request, EventParticipants $participant)
    {
        // Check if user has permission to update this participant
        if (Auth::user()->role !== 'admin' && $participant->event->id_master !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'id_event' => 'required|exists:events,id',
            'id_user' => 'required|exists:users,id',
            'status' => 'required|in:pending,confirm',
        ]);

        $participant->update($validated);

        return redirect()->route('joined')
            ->with('success', 'Participant updated successfully.');
    }

    public function destroy(EventParticipants $eventParticipan)
    {
        if (Auth::user()->role === 'admin' || $eventParticipan->event->id_master === Auth::id()) {
            $eventParticipan->delete();

            return redirect()->route('event.show', $eventParticipan->id_event)
                ->with('success', 'Participant removed successfully.');
        }

        abort(403, 'Unauthorized action.');
    }

    public function scan(Request $request, EventParticipants $eventParticipan)
{
    // Temukan id_master berdasarkan id_event
    $id_master = Events::find($eventParticipan->id_event, ['id_master']);

    // Pastikan user terautentikasi dan memiliki izin
    if (Auth::check() && Auth::id() == $id_master['id_master']) {

        // Cek jika status sudah "Present"
        if ($eventParticipan->status == 'Present') {
            return response()->json(['message' => 'Invalid or already used QR code.'], 409);
        }

        // Update status ke "Present"
        $eventParticipan->update([
            'status' => 'Present'
        ]);

        // Buat nama file PDF tanpa spasi
        $nameWithoutSpaces = str_replace(' ', '', $eventParticipan->participant->name);
        $pdfPath = public_path("certificates/{$nameWithoutSpaces}_certificate.pdf");

        // Pastikan folder "certificates" ada
        if (!file_exists(public_path('certificates'))) {
            mkdir(public_path('certificates'), 0775, true);
        }

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Render HTML dari view untuk sertifikat
        $html = View::make('event.certificate.index', [
            'name' => $eventParticipan->participant->name
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Simpan PDF ke local storage
        $pdfContent = $dompdf->output();
        file_put_contents($pdfPath, $pdfContent);

        // Log untuk memastikan file PDF berhasil disimpan
        Log::info("PDF file generated: {$pdfPath}");
        
        // Verifikasi apakah file PDF berhasil dibuat
        if (!file_exists($pdfPath)) {
            Log::error("Failed to generate PDF file: {$pdfPath}");
            return response()->json(['message' => 'Failed to generate certificate.'], 500);
        }

        // Kirim email dengan sertifikat sebagai lampiran menggunakan Mailable
        try {
            Log::info("Attempting to send email with attachment: {$pdfPath}");
            
            Mail::to($eventParticipan->participant->email)
                ->send(new CertificateMailable($eventParticipan, $eventParticipan->participant->name, $pdfPath));
                
            Log::info("Email sent successfully to {$eventParticipan->participant->email}");
            
        } catch (\Exception $e) {
            Log::error("Failed to send email: " . $e->getMessage());
            return response()->json(['message' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        // Kembalikan respon sukses
        return redirect()->route('home')->with('success', 'QR code verified and certificate sent successfully.');
    }

    // Jika user tidak memiliki izin
    return response()->json(['message' => 'You do not have permission.'], 403);
}


}
