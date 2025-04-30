<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="compiled_css/bootstrap.css" rel="stylesheet">
    <link href="zapisano.css" rel="stylesheet" />
</head>

<body class="bg-light">


    <div style="position: fixed; z-index: 0; margin-top: -110px;">
        <img class="w-100" src="images/e0754079249c561e89df1f9f7ed39d80.png" style="transform: rotate(180deg);" />
    </div>

    <div class="container shadow mt-10 bg-white rounded-5 p-5 mb-5" style="position: relative; z-index: 1;">
        <div class="text-center display-3 fw-bold delius-unicase-bold text-green">NAROČILO</div>
        <!-- register form -->
        <form method="post" id="narocilo_form" action="register.php" name="registerform">

            <!-- the user name input field uses a HTML5 pattern check -->
            <label class="fw-bold mt-4" for="login_input_username" hidden>Username (only letters and numbers, 2 to 64 characters)</label>
            <input id="login_input_username" class="form-control" type="hidden" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

            <!-- the email input field uses a HTML5 email type check -->
            <label class="fw-bold mt-4" for="login_input_email">Elektronski naslov</label>
            <input id="login_input_email" class="form-control" type="email" name="user_email" required />

            <label class="fw-bold mt-4" for="login_input_password_new">Geslo (min. 6 znakov)</label>
            <input id="login_input_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

            <label class="fw-bold mt-4" for="login_input_password_repeat">Ponovi geslo</label>
            <input id="login_input_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

            <div class="text-muted fst-italic text-sm">Elektronski naslov in geslo boste potrebovali pri vstopu v portal za naročilo.</div>
            <hr class="my-4" />
            <!-- Ime -->
            <label class="fw-bold mt-4" for="ime">Ime:</label>
            <input id="ime" class="form-control" type="text" name="ime" required />

            <!-- Priimek -->
            <label class="fw-bold mt-4" for="priimek">Priimek:</label>
            <input id="priimek" class="form-control" type="text" name="priimek" required />

            <!-- Naslov -->
            <label class="fw-bold mt-4" for="naslov">Naslov:</label>
            <input id="naslov" class="form-control" type="text" name="naslov" required />

            <div class="d-flex gap-3 mt-4">
                <div style="width: 200px;">
                    <label class="fw-bold" for="posta_stevilka">Poštna številka:</label>
                    <input id="posta_stevilka" class="form-control" type="text" pattern="\d{4,5}" name="posta_stevilka" required />
                </div>

                <div class="flex-fill">
                    <label class="fw-bold" for="posta">Pošta:</label>
                    <input id="posta" class="form-control" type="text" name="posta" required />
                </div>
            </div>


            <!-- Skupina -->
            <label class="fw-bold mt-4" for="skupina">Ime skupina oz. razred:</label>
            <input id="skupina" class="form-control" type="text" name="skupina" required />

            <!-- Tip izgleda (radio buttons) -->
            <label class="fw-bold mt-4">Tip izgleda:</label><br>
            <input type="radio" id="tip1" name="tip_izgleda" value="minimalistic" required />
            <label for="tip1">Minimalističen</label><br>
            <input type="radio" id="tip2" name="tip_izgleda" value="barvni" />
            <label for="tip2">Barvni</label><br>
            <input type="radio" id="tip3" name="tip_izgleda" value="temen" />
            <label for="tip3">Temen</label><br>

            <!-- Način plačila (select) -->
            <label class="fw-bold mt-4" for="nacin_placila">Način plačila:</label>
            <select id="nacin_placila" class="form-control" name="nacin_placila" required>
                <option value="">-- izberi --</option>
                <option value="paypal">PayPal</option>
                <option value="po povzetju">Plačilo po povzetju</option>
                <option value="bančno nakazilo">Bančno nakazilo</option>
            </select>

            <div class="row mt-4">
                <div class="col-12 col-md-3">
                    <input class="btn btn-lg btn-primary rounded-5 w-100 px-4" type="submit" name="register" value="Naroči" />
                </div>
            </div>

        </form>
        <div class="text-end mt-4">
            <a class="mt-5 text-decoration-none text-muted fst-italic" href="index.html">Nazaj na prvo stran</a>
        </div>


        <?php
        // show potential errors / feedback (from registration object)
        if (isset($registration)) {
            if ($registration->errors) {
                foreach ($registration->errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            if ($registration->messages) {
                foreach ($registration->messages as $message) {
                    echo "<div class='alert alert-light'>$message</div>";
                    // Add JavaScript to trigger the modal on success
                    echo "
                <script type='text/javascript'>
                    window.onload = function() {
                        var modalMessage = '$message';
                        document.getElementById('modalMessage').innerText = modalMessage;
                        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                        myModal.show();
                    }
                </script>
            ";
                }
            }
        }
        ?>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="autoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="autoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-green" id="autoModalLabel">Hvala za oddajo naročila!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalMessage">
                    <div>Sedaj se lahko prijavite v svoj račun. </div>
                    <div class="text-center">
                        <button class="btn btn-light mt-3 round-5 border-1 border-dark w-100" onclick="window.location.href='login.php'">Prijava v račun</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        // Attach an event listener to the form submission
        document.getElementById('narocilo_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            // Trigger the modal after a successful form submission or other event
            var myModal = new bootstrap.Modal(document.getElementById('autoModal'));
            myModal.show();
        });
    </script>
    <!-- generate random username -->
    <script>
        function generateRandomUsername(length = 16) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        document.getElementById('login_input_username').value = generateRandomUsername();
    </script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>