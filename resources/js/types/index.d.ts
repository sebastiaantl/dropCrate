import type { Config } from 'ziggy-js';


export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    ziggy: Config & { location: string };
    [key: string]: unknown;
}
