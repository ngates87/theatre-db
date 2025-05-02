namespace TCMS {

    export interface EventItem {
        ID: string;
        Slug: string;
        Title: string;
        EarlyTicketPrice?: any;
        DoorTicketPrice?: any;
        Notes?: any;
        Company_ID?: any;
        CreatedBy_ID?: any;
        EditedBy_ID?: any;
        Artfully_ID?: any;
        CurrentSeason?: any;
        PublishCast?: any;
        Active: boolean;
        Company: string;
        EventWhen?: any;
    }

}