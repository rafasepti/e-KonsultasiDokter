{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
{{-- <div class="messenger-infoView-btns">
    @if (auth()->user()->active_status)
        <span class="status-indicator online"></span>
        <span class="status-text">Online</span>
    @else
        <span class="status-indicator offline"></span>
        <span class="status-text">Offline</span>
    @endif
</div> --}}
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Hapus Pesan</a>
</div>
@if (auth()->user()->hak_akses == 'dokter')
    <div class="messenger-infoView-btns">
        <a href="#" class="danger ended-conversation">Akhiri Sesi Chat</a>
    </div>
@endif
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>
