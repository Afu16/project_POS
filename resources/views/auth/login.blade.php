    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --dark-color: #2b2d42;
            --light-color: #f8f9fa;
            --success-color: #4bb543;
            --error-color: #f44336;
        }

        body {
            background-color: var(--light-color);
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .left-panel {
            flex: 1;
            background: url('https://img.freepik.com/free-vector/small-business-concept-illustration_114360-2581.jpg') no-repeat center center;
            background-size: cover;
        }

        .right-panel {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            position: relative;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.4s ease;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 5px;
            width: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        h1 {
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            color: var(--dark-color);
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .login-button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .login-button:hover {
            background-color: var(--secondary-color);
        }

        .forgot-link {
            text-align: right;
            display: block;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .forgot-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .left-panel {
                height: 200px;
                flex: none;
            }

            .right-panel {
                flex: none;
                padding: 2rem 1rem;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="wrapper">
        <div class="left-panel"></div>

        <div class="right-panel">
            <div class="login-container">
                <h1>Login Kasir</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Remember me</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="login-button">Login</button>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="forgot-link">
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

