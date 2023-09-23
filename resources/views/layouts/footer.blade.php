        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>{{ date('Y') }} &copy; Generate by
                        <a href="#" target="_blank">ITTP</a>
                    </p>
                </div>
                <div class="float-end">
                    <p>Mazer Admin by
                        <a href="#" target="_blank">UPT Balai Diklat KKB Banyumas</a>
                    </p>
                </div>
            </div>
        </footer>
        </div>

        <script src="{{ asset('mazer') }}/js/app.js"></script>
        <script src="{{ asset('mazer') }}/js/bootstrap.js"></script>
        <script src="{{ asset('mazer') }}/extensions/jquery/jquery.min.js"></script>
        <script>
            setTimeout(function() {
                var errorMessage = document.getElementById('popup-message');
                errorMessage.style.display = 'none';
            }, 3000);
        </script>


        @stack('js')
        </body>

        </html>
