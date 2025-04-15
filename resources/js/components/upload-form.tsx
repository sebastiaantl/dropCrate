import axios from "axios"
import { useState } from "react";

export default function UploadForm(){

    const [file, setFile] = useState<File | null>(null);
    const [password, setPassword] = useState<string>('');
    const [uploading, setUploading] = useState<boolean>(false);
    const [link, setLink] = useState<string>('');


    const handleSubmit = async (e: React.FormEvent) => {

        e.preventDefault();

        try{

            if (!file){
                return;
            }

            const formData = new FormData();
            formData.append('file', file);

            if (password){
                formData.append('password', password);
            }

            setUploading(true);
            const response = await axios.post('/upload', formData);
            if (response.data.link){
                setLink(response.data.link);
            }
        }
        catch (error){

            alert("An error occured while uploading file!")
            console.error(error);

        }
        finally {
            setUploading(false);
        }

    }

    return (

        <form onSubmit={handleSubmit} className="flex flex-col gap-6 p-8 m-4 bg-white rounded-xl shadow-lg w-full max-w-md mx-auto border border-gray-200">
          <h1 className="text-2xl font-bold text-center text-gray-800">DropCrate File Share</h1>

          <div className="flex flex-col gap-2">
            <label htmlFor="file" className="text-sm font-medium text-gray-700">
              Upload File
            </label>
            <input
              type="file"
              id="file"
              className="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 hover:cursor-pointer"
              onChange={ (e) => setFile(e.target.files?.[0] || null)}
              required
            />
          </div>

          <div className="flex flex-col gap-2">
            <label htmlFor="password" className="text-sm font-medium text-gray-700">
              Optional Password (for private access)
            </label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Leave blank for public link"
              className="w-full px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
              onChange={ (e) => setPassword(e.target.value)}
            />
          </div>

          <input
            type="submit"
            value={uploading ? "Uploading..." : "Generate Shareable Link"}
            className="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition font-semibold hover:cursor-pointer hover:bg-sky-500"
          />

            {link && (
                <p className="text-green-600 mt-4">
                File uploaded! Link: <a href={link} className="underline">{link}</a>
                </p>
            )}

        </form>

    )


}