import config from '@/app/config';

import { LocalizationHelper, __ } from '@/core/helpers/localizationHelper';

export default class {
    static config: any = config;
    static locale: string;

    static __: any = __;
}
