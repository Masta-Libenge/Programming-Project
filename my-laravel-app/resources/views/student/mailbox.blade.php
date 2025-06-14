@extends('layouts.app')

@section('title', 'Mailbox')

@section('content')
<div class="flex pt-20 h-[calc(100vh-80px)] overflow-hidden">
    {{-- Sidebar : Liste des mails --}}
    <aside class="w-1/3 bg-gray-100 border-r border-gray-300 overflow-y-auto">
        <h2 class="p-4 text-xl font-semibold text-blue-700 border-b">Boîte de réception</h2>
        <ul id="mailList">
            @foreach($mails as $mail)
                <li onclick="showMail({{ $mail->id }})" class="cursor-pointer px-4 py-3 border-b hover:bg-gray-100 transition">
                    <div class="font-semibold text-gray-800">
                        {{ $mail->subject }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $mail->sender_name }} – {{ \Carbon\Carbon::parse($mail->created_at)->format('d/m/Y H:i') }}
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>

    {{-- Affichage du contenu du mail --}}
    <section class="w-2/3 p-6 overflow-y-auto" id="mailContent">
        <p class="text-gray-400 text-center">Sélectionnez un message à gauche</p>
    </section>
</div>
@endsection

@push('scripts')
<script>
    const mails = @json($mails);

    function showMail(id) {
        const mail = mails.find(m => m.id === id);
        if (!mail) return;

        const container = document.getElementById('mailContent');
        container.innerHTML = `
            <div>
                <h2 class="text-xl font-bold text-blue-800 mb-2">${mail.subject}</h2>
                <p class="text-sm text-gray-500 mb-1"><strong>De :</strong> ${mail.sender_name}</p>
                <p class="text-sm text-gray-500 mb-4"><strong>Envoyé le :</strong> ${new Date(mail.created_at).toLocaleString()}</p>
                <div class="text-gray-800 whitespace-pre-line">${mail.body}</div>
            </div>
        `;
    }
</script>
@endpush
