<div class="modal-header">
	<div class="modal-title">@yield('title')</div>
	<div class="modal-close icon">clear</div>
</div>
<div class="modal-body">@yield('body')</div>
@if (View::hasSection('footer'))
	<div class="modal-footer">@yield('footer')</div>
@endif
