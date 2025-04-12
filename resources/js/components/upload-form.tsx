export default function UploadForm(){

    return (

        <form className="flex flex-col gap-6 p-8 m-4 bg-white rounded-xl shadow-lg w-full max-w-md mx-auto border border-gray-200">
          <h1 className="text-2xl font-bold text-center text-gray-800">DropCrate File Share</h1>

          <div className="flex flex-col gap-2">
            <label htmlFor="file" className="text-sm font-medium text-gray-700">
              Upload File
            </label>
            <input
              type="file"
              id="file"
              className="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
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
            />
          </div>

          <input
            type="submit"
            value="Generate Shareable Link"
            className="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition font-semibold"
          />
        </form>

    )


}