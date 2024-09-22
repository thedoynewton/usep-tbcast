import React from 'react';

const Login = () => {
    const handleGoogleLogin = () => {
        window.location.href = route('google.login'); // Route defined for Google SSO in Laravel
    };

    return (
        <div className="min-h-screen flex justify-center items-center bg-gray-100">
            <div className="bg-white p-8 rounded shadow-md w-96">
                <h2 className="text-2xl font-bold mb-6 text-center">Login</h2>
                <button
                    onClick={handleGoogleLogin}
                    className="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Sign in with Google
                </button>
            </div>
        </div>
    );
};

export default Login;
