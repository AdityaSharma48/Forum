<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="login_modalLabel">Login to iDiscuss</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/UNIT1/cwh/Forum/Partials/_handleLogin.php" method="POST">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="username" class="form-label">Name</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="LoginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="LoginEmail" name="LoginEmail" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="LoginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="LoginPassword" name="LoginPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>