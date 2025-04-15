import type { Config } from 'ziggy-js';


export interface SharedData {
    file: {
        short_url: string
    };
    ziggy?: Config & { location: string };
    [key: string]: unknown;
}
