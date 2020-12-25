<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
<script>
    window.addEventListener('alert',event=>{const type=event.detail.type ?? null;const options={position:'top-end',timer:3000,toast:true,title:event.detail.message ?? '',text:null,showCancelButton:false,showConfirmButton:false,...event.detail.options};Swal.fire({...options,icon:type})})
</script>

@if (session()->has('alert.config')))
    @if(config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    @if (config('sweetalert.alwaysLoadJS') === false && config('sweetalert.neverLoadJS') === false)
        <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
    @endif
    <script>
        Swal.fire({!! session()->pull('alert.config') !!});
    </script>
@endif



