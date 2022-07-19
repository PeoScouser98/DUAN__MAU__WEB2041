<?php
$error = [];
if (isset($_POST['send-message'])) {
    if (empty($error)) {
        drop_message($_POST['email'], $_POST['password'], $_POST['name'],  $_POST['content']);
    } else echo "<script>alert(`Failed to send message!`)</script>";
}
?>
<style>
    .contact-box:hover {
        transition: ease 500ms;
        transform: translateX(-10%);
    }
</style>
<div class="container-fluid bg-white">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row align-items-center p-5">
            <div class="col-7"><img src="./assets/img/contact-image.png" alt="" class="img-fluid"></div>
            <div class="col-5 shadow-lg p-5 contact-box" style="border-radius:1rem;">
                <h1 class="text-center fw-light mb-5 "><i class="bi bi-envelope"></i> Contact Us</h1>
                <form action="?page=contact" class="" method="POST">
                    <div class="mb-5 form-floating">
                        <input type="text" class="form-control  rounded-0 border-0 border-bottom" name="name" id="floatingName" aria-describedby="emailHelpId" placeholder="Email">
                        <label for="floatingName" class="form-label">Your name</label>
                        <small class="text-danger fw-bold">
                            <?php
                            check_empty('name', 'name');
                            ?>
                        </small>
                    </div>
                    <div class="mb-5 form-floating">
                        <input type="email" class="form-control  rounded-0 border-0 border-bottom" name="email" id="floatingEmail" aria-describedby="emailHelpId" placeholder="Email">
                        <label for="email" class="form-label"> Email</label>
                        <small class="text-danger fw-bold">
                            <?php
                            check_empty('email', 'email');
                            check_email('email');
                            ?>
                        </small>
                    </div>
                    <div class="mb-5 form-floating">
                        <input type="password" class="form-control  rounded-0 border-0 border-bottom" name="password" id="floatingPassword" aria-describedby="emailHelpId" placeholder="Email">
                        <label for="floatingPassword" class="form-label">Password</label>
                        <small class="text-danger fw-bold">
                            <?php
                            check_empty('password', 'password');
                            ?>
                        </small>
                    </div>
                    <!-- content -->
                    <div class="mb-5 form-floating">
                        <textarea class="form-control border-0   rounded-0 border-bottom" name="content" id="floatingContent" rows="10" placeholder="Content"></textarea>
                        <label for="content" class="form-label"> Content</label>
                        <small class="text-danger fw-bold">
                            <?php
                            check_empty('content', 'content');
                            ?>
                        </small>
                    </div>
                    <div class="mb-5">
                        <button type="submit" name="send-message" class="btn btn-dark d-block p-3 w-auto mx-auto">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>