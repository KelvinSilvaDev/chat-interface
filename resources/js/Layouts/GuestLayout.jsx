import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
    const isLoginRoute = route().current('login');

    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <Link href="/">
                    <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
                </Link>
            </div>

            <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {children}
            </div>

            {isLoginRoute && (
                <div className="mt-6 text-center">
                    <div className="mt-4">
                        <Link href={route('register')} className="text-sm text-gray-600 hover:text-gray-900 underline">
                            Não possui uma conta? Registre-se
                        </Link>
                    </div>
                </div>
            )}
        </div>
    );
}
