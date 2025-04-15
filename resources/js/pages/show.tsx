import Nav from "@/components/nav";
import "../../css/home.css";
import File from "@/components/file";
import { usePage } from "@inertiajs/react";
import type { SharedData } from "@/types";

export default function Show() {

    const {file, locked} = usePage<SharedData>().props;

    return (
        <div className="background">
            <Nav />
            <File file={file} locked={locked} />
        </div>
    );
}