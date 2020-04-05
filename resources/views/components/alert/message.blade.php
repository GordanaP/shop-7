@if ($errors->any())

    <x-alert.alert type="danger" />

@elseif(Session::has('success'))

    <x-alert.alert type="success" />

@endif
