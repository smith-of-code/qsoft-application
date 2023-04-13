import { MiniBasket } from '../../components/miniBasket/src/component';
import { SalesReportPage } from '../../components/salesReportPage/src/component';
import { Pets } from '../../components/pets/src/component';
import { PersonalData } from '../../components/personalData/src/component';
import { LegalEntity } from '../../components/legalEntity/src/component';
import { SelectOffer } from "../../components/detailOffers/src/offerSelect";
import { OfferArticle } from "../../components/detailOffers/src/offerArticle";
import { OfferPrice } from "../../components/detailOffers/src/offerPrice";
import { SelectOfferMobile } from "../../components/detailOffers/src/offerSelectMobile";
import { OfferImage } from "../../components/detailOffers/src/offerImage";
import { LoyaltyStatusTale } from "../../components/loyaltyStatusTale/src/component";

export default {
    // Обязательно сверху
    '#miniBasket': MiniBasket,

    '#pets': Pets,
    '#personalData': PersonalData,
    '#legalEntity': LegalEntity,
    '#salesReportPage': SalesReportPage,

    '#loyaltyStatusTale': LoyaltyStatusTale,
    // DetailOfferPage components
    '#offerSelect':  SelectOffer,
    '#offerArticle':  OfferArticle,
    '#offerSelectMobile':  SelectOfferMobile,
    '#imageSlider': OfferImage,
    '#offerPrice':  OfferPrice,
};