<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT.'/public/css/admin/profile.css'?>">
    <script src="<?php echo APPROOT.'/public/js/patientdashboard/patient.js';?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>Patient dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_2">
            <div class="header">
                <h1><?php echo $data['full_name']?><br><p>You have the option to modify your profile details here.</p></h1>
                
                <div class="profile-picture">
                    <img id="profile-image" src=<?php echo APPROOT."/public/img/profile/".$data['profile_image']?> alt="Profile Picture">
                    <label for="profile-picture-input"><i class="fas fa-camera"></i></label>
                    <input type="file" id="profile-picture-input" accept="image/*" onchange="updateProfilePicture(this.files[0])">
                </div>
            </div>
            <form id="profileEditForm">
                <div class="form-group horizontal">
                    <div>
                        <label for="name"><i class="fas fa-user icon"></i> Name*</label>
                        <input type="text" id="name" name="name" placeholder="<?php echo $data['full_name']?>" pattern="[A-Za-z.' ']+" >
                    </div>
                    <div>
                        <label for="email"><i class="fas fa-envelope icon"></i> Email</label>
                        <input type="email" id="email" name="email" placeholder="<?php echo $data['email']?>" disabled>
                    </div>
                </div>
                <div class="form-group horizontal">
                    <div>
                        <label for="dob"><i class="fas fa-at icon"></i> Date Of Birth</label>
                        <input type="date" id="dob" name="dob" placeholder="<?php echo $data['dob']?>" >
                    </div>
                    <div>
                        <label for="phone"><i class="fas fa-phone icon"></i> Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="<?php echo $data['phone']?>" >
                    </div>
                </div>
                <div class="form-group horizontal">
                    <div>
                        <label for="new_password"><i class="fa-solid fa-key icon"></i> New Password</label>
                        <input type="password" id="new_password" name="new_password" placeholder="***********" >
                    </div>
                    <div>
                        <label for="confirm_password"><i class="fa-solid fa-key icon"></i> Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="***********" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="address"><i class="fas fa-pen icon"></i>Address</label>
                    <textarea id="address" name="address" rows="3" placeholder="<?php echo $data['address']?>" ></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" ><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon
            src="https://cdn.lordicon.com/guqkthkk.json"
            trigger="in"
            delay="15"
            state="in-reveal">
            </lord-icon>
        </div>
        <p> Success! Account Updated.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon
            src="https://cdn.lordicon.com/akqsdstj.json"
            trigger="in"
            delay="15"
            state="in-reveal">
            </lord-icon>
        </div>
        <p>Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>
  

  <script>
    function updateProfilePicture(file) {
      const profileImage = document.getElementById('profile-image');
      profileImage.src = URL.createObjectURL(file);

      const top_bar_profile_pic = document.getElementById('top_bar_pic');
      top_bar_profile_pic.src = URL.createObjectURL(file);

    //   URL.revokeObjectURL(file);
    }

    const profileForm =document.getElementById("profileEditForm");
    const profileImage = document.getElementById('profile-picture-input');

    profileForm.addEventListener('submit', e => {
        e.preventDefault();

        const formData = new FormData(profileForm);
        formData.append('profileImage', profileImage.files[0]);
        // console.log(formData);
        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/admin/editProfile`;

        fetch(link, {
            method: 'POST',
            body: formData
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('Error in saving profile');
            }
            return res.json();
        })
        .then(data => {
            console.log(data);
            if(data[status]="success"){
                showSuccessMessage()
            }else{
                showErrorMessage()
            }
        })
        .catch(err => {
            showErrorMessage()
            console.error(err);
        });

    });

  </script>
</body>
</html>