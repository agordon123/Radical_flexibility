import { createI18n } from 'vue-i18n'
import messages from './messages/messages'

const i18n = createI18n({
  locale: 'en', // Set the default language
  messages,
})

export default i18n;
