// resources/js/Pages/AccessDenied.jsx
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function AccessDenied() {
    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Access Denied</h2>}
        >
            <Head title="Access Denied" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            You do not have permission to access this page.
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
