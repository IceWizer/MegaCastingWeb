import { useCrud } from "@store/utils";
import { apiRequest } from "../../axios";

const { name, store } = useCrud("casting_offers");

store.actions.index = ({ commit }, param) => {
    return new apiRequest(
        `casting_offers/index`,
        "GET",
        null,
        param
    )
}

export default {
    name,
    store,
}
