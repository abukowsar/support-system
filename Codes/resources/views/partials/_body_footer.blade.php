<!-- Footer -->
<footer class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    {{_t(__('message.copyright'))}} &copy; {{ date('Y') }}
                    <a href="{{route('home')}}" class="font-weight-bold ml-1">
                        {{ _t(request()->appData->site_name) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
