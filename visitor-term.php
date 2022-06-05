<?php

session_start(); 

if(isset($_SESSION['id'])){
    include("student-navi.php");
}
else{
    include("visitor-navi.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="#">
        <link rel="icon" type="image/png" href="Images/skillsoft-favicon.png">
        <title>Terms & Conditions Page</title>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap');
            
            @media screen and (max-width: 850px) {
                #term-container {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                }
            }

            @media screen and (max-width: 1200px) {
                #term-container {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                }
            }

            .term-container {
                width: 1308px;
                height: 100%;
                margin-left: 119px;
                margin-right: 119px;
                margin-bottom: 99px;
            }

            .term-container h1 {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 700;
                font-size: 36px;
                line-height: 49px;
                color: #50514F;
                margin-top: 0;
                margin-bottom: 15px;
            }

            .term-content {
                margin-bottom: 35px;
            }

            .term-content h2 {
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 700;
                font-size: 24px;
                line-height: 32px;
                color: #50514F;
                margin-top: 0;
                margin-bottom: 4px;
            }

            .term-content p {
                max-width: 878px;
                word-wrap: break-word;
                font-family: 'Nunito';
                font-style: normal;
                font-weight: 400;
                font-size: 18px;
                line-height: 30px;
                text-align: justify;
                text-transform: capitalize;
                color: #50514F;
                margin-top: 0;
                margin-bottom: 0;
            }

        </style>
    </head>
    <body>

        <div class="term-container" id="term-container">
            <h1 class="term-title">Terms & Conditions</h1>

            <div class="term-content">
                <h2>Welcome to Skillsoft</h2>
                <p>
                These Terms apply to your use of the Skillsoft! Services and our Platform, and we encourage you to read them carefully. 
                Please also refer to the definitions set out at the bottom of this page. The Terms and any attachments related to it, including our 
                Acceptable Use Policy, applicable guidelines and any Service Plan(s), forms a legal Agreement between you and Skillsoft! for your use of the Skillsoft! Services. 
                If you, or an Organization you are affiliated with, have entered into an Enterprise Agreement with Skillsoft!, 
                your use of the Skillsoft! Services and Resources will be governed by the Enterprise Agreement and the documents incorporated therein.
                <br><br>
                These Terms define the terms and conditions under which you are allowed to use the Skillsoft! Services and consume Resources. 
                If you do not agree to these Terms, you must immediately discontinue your use of the Skillsoft! Services and Resources.
                </p>
            </div>
            <div class="term-content">
                <h2>Account Security</h2>
                <p>
                As the creator of your Skillsoft! account you have access and control over the Skillsoft! account and the devices that are used to access the Service. 
                To maintain control over the account and to prevent anyone from accessing the account, you should maintain control over the devices that are used to access the 
                Service and not reveal the password to anyone. you are responsible for updating and maintaining the 
                accuracy of the information you provide to us relating to your account. you are also responsible for preventing unauthorized access and use of your account by any other 
                than you. We can terminate your account or place your account on hold in order to protect you, 
                Skillsoft! or our partners from conducting or attempting to conduct identity theft or other fraudulent activity.
                </p>
            </div>
            <div class="term-content">
                <h2>Monitoring of User Content</h2>
                <p>
                Unless agreed differently in a separate agreement with us, Skillsoft! may review, monitor, edit or remove User Content in our sole discretion, 
                but is under no obligation to do so. In all cases, Skillsoft! reserves the right to remove or disable access to any User Content that breaches the Agreement, 
                including breach of our Acceptable Use Policy and Editorial Guidelines. Removal or disabling of access to User Content shall be at our sole discretion.
                </p>
            </div>
            <div class="term-content">
                <h2>Data protection</h2>
                <p>
                The Data Processing Agreement located here shall govern with respect to the protection of personal data processed in connection with this Agreement.
                </p>
            </div>
            <div class="term-content">
                <h2>Limitation of liability</h2>
                <p>
                ***To the maximum extent permitted by law, in no event will Skillsoft!, its officers, shareholders, employees, agents, directors, subsidiaries, affiliates, successors, assigns, 
                suppliers, or licensors be liable for (1) any indirect, special, incidental, punitive, exemplary, or consequential damages; or (2) any loss of use, data, business, or profits 
                (whether direct or indirect), in all cases arising out of the use or inability to use the Skillsoft! service, Third Party Applications, or Third Party Application content, 
                regardless of legal theory, without regard to whether Skillsoft! has been made aware of the possibility of those damages, and even if a remedy fails of its essential purpose.  
                Skillsoft!’s aggregate liability for all claims arising under or in connection with 
                this Agreement shall be limited to the amounts paid by you to Skillsoft! under this Agreement during the twelve months immediately preceding the last event giving rise to 
                liability.
                </p>
            </div>
        </div>

        <?php include("visitor-footer.php");?>
    </body>
</html>