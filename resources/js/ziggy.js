const Ziggy = {
    url: "http://localhost:8000",
    port: 8000,
    defaults: {},
    routes: {
        "cashier.payment": {
            uri: "stripe/payment/{id}",
            methods: ["GET", "HEAD"],
        },
        "cashier.webhook": { uri: "stripe/webhook", methods: ["POST"] },
        "sanctum.csrf-cookie": {
            uri: "sanctum/csrf-cookie",
            methods: ["GET", "HEAD"],
        },
        "ignition.healthCheck": {
            uri: "_ignition/health-check",
            methods: ["GET", "HEAD"],
        },
        "ignition.executeSolution": {
            uri: "_ignition/execute-solution",
            methods: ["POST"],
        },
        "ignition.updateConfig": {
            uri: "_ignition/update-config",
            methods: ["POST"],
        },
        home: { uri: "/", methods: ["GET", "HEAD"] },
        "profile.edit": { uri: "profile/{id}/edit", methods: ["GET", "HEAD"] },
        faq: { uri: "faq", methods: ["GET", "HEAD"] },
        about: { uri: "about", methods: ["GET", "HEAD"] },
        gallery: { uri: "gallery", methods: ["GET", "HEAD"] },
        "painting.show": {
            uri: "painting/{painting}",
            methods: ["GET", "HEAD"],
        },
        "donate.checkout": { uri: "donate/checkout", methods: ["POST"] },
        "painting.checkout": { uri: "painting/checkout", methods: ["POST"] },
    },
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
