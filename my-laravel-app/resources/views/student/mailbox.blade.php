@extends('layouts.app')

@section('title', 'Mailbox')

@push('styles')
<style>
    .mailbox-container {
        height: calc(100vh - 4rem);
    }
</style>
@endpush

@section('content')
<div class="mailbox-container flex pt-20">

    {{-- Liste des mails --}}
    <div class="w-1/3 border-r border-gray-300 bg-white overflow-y-auto">
        <div class="p-4 font-bold text-lg text-blue-800 border-b">Boîte de réception</div>

        <ul id="mailList">
        @foreach($mails as $mail)
            <li onclick="showMail({{ $mail->id }})" class="...">
                <div class="font-semibold text-gray-800">
                    {{ $mail->subject }} - {{ $mail->sender_name }}
                </div>
            </li>
        @endforeach
        </ul>
    </div>

    {{-- Contenu du mail sélectionné --}}
    <div class="w-2/3 bg-white p-6 overflow-y-auto" id="mailContent">
        <div class="text-gray-400 text-center">Sélectionnez un message à gauche</div>
    </div>

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
