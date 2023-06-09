import { useCrud } from "@store/utils";
import { apiRequest } from "../../axios";

const { name, store } = useCrud("casting_pack_offers");

export default {
    name,
    store,
}
