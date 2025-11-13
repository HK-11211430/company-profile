<div style="font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color: #111827;">
    <h2>Pesan Baru dari Situs {{ config('app.name') }}</h2>

    <p><strong>Nama:</strong> {{ $contact->nama }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Subjek:</strong> {{ $contact->subjek ?? '-' }}</p>

    <hr />

    <p>{!! nl2br(e($contact->pesan)) !!}</p>

    <hr />

    <p>Waktu: {{ $contact->created_at->format('d M Y H:i') }}</p>
</div>
