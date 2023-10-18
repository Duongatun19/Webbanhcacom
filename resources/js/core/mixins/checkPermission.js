import CONSTANTS from '../utils/constants';
import router from "../../router";
export default {
    methods: {
        $isPermiss(key){
            if(typeof(localStorage) && localStorage.getItem(CONSTANTS.ACCESS_PERMISSION).includes(key)) {
                return true;
            }else{
                return false;
            }
        }
    }
}
