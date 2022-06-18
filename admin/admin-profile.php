<?php
?>
<style>
    #upload-label {
        opacity: 0;
        border-radius: 12px;
        transition: ease-in-out 0.3s;
        color: #3f3f3f;
        font-size: 14px;
        font-weight: 500;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    #upload-label:hover {
        color: #fff;
        opacity: 1;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .nav-link {
        color: #fff
    }
</style>
<div class="container row px-0">
    <aside class="col-3 bg-dark d-flex justify-content-start flex-column gap-5 position-sticky top-0" style="padding: 50px;">
        <!-- avatar -->
        <div>
            <form action="" method="POST" enctype="multipart/form-data" class="mb-5" onsubmit="loadImage(this)">
                <div class="position-relative w-100 mx-auto">
                    <img src=<?= $ROOT_AVATAR_ADMIN . $userData['avatar'] ?> id="user-image" class="rounded-circle img-fluid d-block mx-auto" style="max-width:200px">
                    <label for="avatar" id="upload-label" class="position-absolute top-50 start-50 translate-middle h-100 rounded-circle" style="width:200px">Upload</label>
                    <input type="file" class="form-control d-none" name="avatar" id="avatar" placeholder="" aria-describedby="fileHelpId" onchange="loadFile(event)">
                    <button type="submit" name="change-avatar" class="position-absolute top-100 start-50 translate-middle text-white fs-3 bg-transparent border-0 "><i class="bi bi-camera"></i></button>
                </div>
                <h4 class="text-white text-center mt-4"><?= $userData['user_name'] ?></h4>
            </form>
            <!-- menu  -->
            <div>
                <ul class="nav d-flex justify-content-start flex-column gap-4 p-0 m-0" style="font-size:1.1rem;list-style:none;">
                    <li class="nav-item text-white"><a href="?page=admin-profile&act=view-profile" class="nav-link "><i class="bi bi-person"></i><span class="ps-2">View Profile</span> </a></li>
                    <li class="nav-item text-white"><a href="?page=admin-profile&act=change-password" class="nav-link "><i class="bi bi-lock"></i><span class="ps-2">Change Password</span></a></li>
                    <li class="nav-item text-white"><a href="?page=admin-profile&act=edit-profile" class="nav-link "><i class="bi bi-pencil-square"></i><span class="ps-2">Edit Profile</span></a></li>
                </ul>
            </div>
        </div>
    </aside>
    <!-- change proile form -->
    <div class="col-9 py-5 bg-white">
        <?php
        if (isset($_GET['act'])) {
            switch ($_GET['act']) {
                case 'view-profile':
                    require './account-detail/view-profile.php';
                    break;
                case 'change-password':
                    require './account-detail/change-password.php';
                    break;
                case 'edit-profile':
                    require './account-detail/edit-profile.php';
                    break;
                default:
                    require './account-detail/view-profile.php';
                    break;
            }
        } else
            require './account-detail/view-profile.php';

        ?>
    </div>
</div>
<script>
    const loadFile = function(event) {
        const photo = document.querySelector('#user-image');
        photo.style.display = "block";
        photo.src = URL.createObjectURL(event.target.files[0]);
        console.log(photo.src);
    };

    function clearFormData() {
        const inputs = document.querySelectorAll('input');
        for (const input of inputs) {
            if (!input.hasAttribute("disabled"))
                input.value = "";
        }
    }
</script>
<?php
if (isset($_POST['change-avatar']) && isset($_COOKIE['id'])) {
    $path = upload_file('./assets/img/avatar/', "avatar");
    $userId = $_COOKIE['id'];
    execute_query("UPDATE users SET `avatar` = '{$path}' WHERE `user_id` = '{$userId}'");
    echo "<script>alert(`Change avatar successfully`)</script>";
    echo "<script>history.go(-1)</script>";
}
