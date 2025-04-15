import type { SharedData } from "@/types";
import { useEffect, useState } from "react";
import axios from "axios";

export default function File({ file, locked }: SharedData) {

    const [downloaded, setDownloaded] = useState(false);
    const [password, setPassword] = useState('');

    useEffect( () => {
        console.log(password);
    }, [password])

    const handleClick = async () => {

        try {
            
            const formData = new FormData();
            formData.append('password', password);
            
            const response = await axios.post(`/d/${file.short_url}`, formData, {
                responseType: 'blob'
            });
            if (response.status === 200) {

                // Create a temporary download link
                const blob = new Blob([response.data]);
                const url = window.URL.createObjectURL(blob);
    
                const a = document.createElement('a');
                a.href = url;
                a.download = response.headers['content-disposition'].split('filename=')[1] || 'downloaded-file';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
    
                setDownloaded(true);
            } else {
                throw new Error("Invalid HTTP Response");
            }

        }
        catch (error){
            console.error(error);
            alert("Failed To Unlock File");
        }


    }

    return (
        <div className="bg-white p-5 w-1/4 mx-auto rounded-md mt-5 flex flex-col items-center">
            <h1>Download File</h1>
            <img className="w-48 h-48" src="/storage/file.png"/>

            {locked ? 
            <>
                <input onChange={ (e) => {setPassword(e.target.value)} } type="password" placeholder="Insert Password" className="p-2 m-2 border border-gray-300 rounded-md text-sm text-gray-800 w-fit"/>
                <input onClick={handleClick} type="button" value="Unlock And Download File" className="p-2 text-white bg-blue-500 rounded-md w-fit hover:bg-sky-500 hover:cursor-pointer"/>
            </>
            : 
            <>
                <input onClick={handleClick} type="button" value="Download File" className="p-2 text-white bg-blue-500 rounded-md w-fit hover:bg-sky-500 hover:cursor-pointer"/>
            </>
            }

            {downloaded ? <p className="text-green-600 text-lg">Download Started!</p> : ''}
        </div>
    )

}