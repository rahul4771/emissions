import * as Sentry from '@sentry/browser';

let sentryPublicDsn 	= process.env.MIX_SENTRY_DSN_PUBLIC;
let appEnv				= process.env.MIX_APP_ENV;

Sentry.init({ dsn:sentryPublicDsn });
Sentry.setTag("environment", appEnv);