import { InertiaLink } from '@inertiajs/inertia-react';


export default function Home() {
    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-100">
            <div className="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h1 className="text-2xl font-semibold mb-4">Welcome to GPT chat</h1>
                <p className="mb-8">Talk to our AI Chat in real time.</p>
                <div className="space-x-4">
                    <InertiaLink
                        href={route('login')}
                        className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                    >
                        Login
                    </InertiaLink>
                    <InertiaLink
                        href={route('register')}
                        className="border border-blue-500 text-blue-500 py-2 px-4 rounded hover:bg-blue-100"
                    >
                        Register
                    </InertiaLink>
                </div>
            </div>
        </div>
    )
}