import Config from '@/app/config';
import Localization from '@/app/localization';

import Page from '@/core/page';

import FileHelper from '@/core/helpers/fileHelper';
import HttpHelper from '@/core/helpers/httpHelper';
import IteratorHelper from '@/core/helpers/iteratorHelper';
import StringHelper from '@/core/helpers/stringHelper';
import UserHelper from '@/core/helpers/userHelper';

class App {
    static config: typeof Config = Config;
    static localization: typeof Localization = Localization;
    static locale: string;

    static page: Page;
    static components: {
        app?: any;
        layout?: any;
    } = {};

    static enums: any;
    static languages: any;
    static settings: any;
    static user: any;

    static helpers: {
        file: FileHelper;
        http: HttpHelper;
        iterator: IteratorHelper;
        string: StringHelper;
        user: UserHelper;
    } = {
        file: new FileHelper(),
        http: new HttpHelper(),
        iterator: new IteratorHelper(),
        string: new StringHelper(),
        user: new UserHelper(),
    };

    static t(sourceMessage: string, replacements: Object = {}) {
        let message = App.helpers.iterator.get(App.localization.translations, App.locale + '->' + sourceMessage, '->');

        message ??= sourceMessage;

        for (let key in replacements) {
            message = message.replace(':' + key, replacements[key]);
        }

        return message;
    }
}

export default App;
