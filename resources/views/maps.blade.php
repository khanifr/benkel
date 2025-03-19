@extends('masterfront')

@section('contentfront')

<!-- Google Maps dengan iframe -->
<style>
    iframe {
        width: 100%;
        height: 92vh;
        border: 0;
    }
</style>

<!-- Google Maps dengan iframe -->
<iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d99370.15308111905!2d-77.09697640072963!3d38.893859154853516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b7c6de5af6e45b%3A0xc2524522d4885d2a!2sWashington%2C%20DC%2C%20USA!5e0!3m2!1sen!2sid!4v1739773632344!5m2!1sen!2sid"
    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


<!-- Ganti YOUR_API_KEY dengan API key Google Maps Anda -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>

@endsection