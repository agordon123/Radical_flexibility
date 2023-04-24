// See your keys here: https://dashboard.stripe.com/apikeys
import { loadStripe } from '@stripe/stripe-js';


const initStripe =async()=>await loadStripe('pk_test_51Mmj2MDxs152QbBr97fqNjqKtSUEyafFaoNgfip4Uj2fwepJ5vnxcutN6GEXPGGq2Ydv9D5vuBIbs1fwmncclwSn00BFSCTNFs');

export default stripe;



