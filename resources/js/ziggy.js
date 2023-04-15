const Ziggy = {"url":"http:\/\/localhost:8000","port":8000,"defaults":{},"routes":{"cashier.payment":{"uri":"stripe\/payment\/{id}","methods":["GET","HEAD"]},"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"donate.index":{"uri":"api\/donate","methods":["GET","HEAD"]},"home":{"uri":"\/","methods":["GET","HEAD"]},"faq":{"uri":"faq","methods":["GET","HEAD"]},"checkout.index":{"uri":"checkout","methods":["GET","HEAD"]},"checkout.create-payment-intent":{"uri":"checkout\/create-payment-intent","methods":["POST"]},"about":{"uri":"about","methods":["GET","HEAD"]},"gallery":{"uri":"gallery","methods":["GET","HEAD"]},"painting.show":{"uri":"paintings\/{id}","methods":["GET","HEAD"]},"profile.edit":{"uri":"profile\/{id}\/edit","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
