import UploadForm from '@/components/upload-form';
import Navbar from '@/components/nav';
import '../../css/home.css';

export default function Index() {

    return (
        <div className='background'>
            <Navbar />
            <UploadForm />
        </div>
    );
}
