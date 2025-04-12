import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import UploadForm from '@/components/upload-form';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <UploadForm />
        </>
    );
}
