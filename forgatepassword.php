    <?php
    error_reporting(0);
    ?>
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Document</title>
            
            <!-- CSS FILES -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        </head>
        <style>
        /* Reset and basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d1117; /* Dark background */
            font-family: 'Inter', sans-serif;
        }

        main {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .sign-in-form {
            background: #161b22; /* Card background */
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        .hero-title {
            color: #ffffff;
            font-size: 2rem;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .form-floating {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-floating input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #30363d;
            border-radius: 8px;
            background-color: #21262d;
            color: #c9d1d9;
            font-size: 16px;
        }

        .form-floating input:focus {
            border-color: #58a6ff;
            outline: none;
            background-color: #21262d;
            color: #ffffff;
        }

        .form-floating label {
            margin-top: 8px;
            font-size: 14px;
            color: #8b949e;
        }

        .custom-btn {
            background-color: #238636;
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .custom-btn:hover {
            background-color: #2ea043;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive for smaller screens */
        @media (max-width: 600px) {
            .sign-in-form {
                padding: 30px 20px;
            }
        }
    </style>


        <body>
            <main>
                <section class="sign-in-form section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto col-12">
                                <h1 class="hero-title text-center mb-5">Forgot Password</h1>

                                <div class="row">
                                    <div class="col-lg-8 col-11 mx-auto">
                                        <form  method="post" action="forgatemail.php" style="width: 100.666667%;">
                                            <div class="form-floating mb-4">
                                                
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
                                                
                                            </div>
                                            <button type="submit" class="btn custom-btn form-control mt-4 mb-3" name="submit">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <!-- JAVASCRIPT FILES -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            
            <script>
                $(document).ready(function() {
                
                    
                    // Forgot password link click
                    $('#forgotPassword').on('click', function(e) {
                        e.preventDefault();
                        const forgotPasswordModal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));
                        forgotPasswordModal.show();
                    });
                    
                    // Forgot password form submission
                    $('#forgotPasswordForm').on('submit', async function(e) {
                        e.preventDefault();
                        const email = $('#forgotEmail').val();
                        
                        try {
                            const response = await fetch('https://your-api-endpoint.com/api/User/forgot-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(email)
                            });
                            
                            if (response.ok) {
                                alert('Password reset code sent to your email');
                                $('#forgotPasswordModal').modal('hide');
                            } else {
                                const errorData = await response.json();
                                alert(errorData.message || 'Failed to send reset code');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('An error occurred');
                        }
                    });
                });
            </script>
        </body>
    </html>
