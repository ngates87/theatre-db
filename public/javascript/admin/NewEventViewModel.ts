namespace TCMS {

    class AddTrouperViewModel {
        trouperId = ko.observable("");
        trouperRole = ko.observable("");
        catID = ko.observable("");
    }

    class AddPerformanceViewModel {
        venueId = ko.observable("");
        when = ko.observable("");
        typeId = ko.observable("");
    }

    export class NewEventViewModel {
        eventTitle = ko.observable("");
        eventSlug = ko.observable("");
        active = ko.observable(false);

        artfullyId = ko.observable("");
        preEventPrice = ko.observable("");
        doorPrice = ko.observable("");
        eventNotes = ko.observable("");

        trouperInfo = ko.observableArray<ITrouperInfo>([]);
        performanceInfo = ko.observableArray<IEventInfo>([]);

        newTrouperRow = ko.observable(new AddTrouperViewModel());
        newPerformance = ko.observable(new AddPerformanceViewModel());

        

        // pass in editor ref?
        constructor(data?: IEventOverview) {
            this.load(data);

            this.addTrouper = this.addTrouper.bind(this);
            this.addPerformance = this.addPerformance.bind(this);
        }

        addTrouper() {
            var name = $("#selectTrouper option:selected").text();
            var catName = $("#selectTrouperCategory option:selected").text();

            var toAdd:ITrouperInfo = {
                trouperID: this.newTrouperRow().trouperId().toString(),
                fullName: name,
                role: this.newTrouperRow().trouperRole(),
                catDisplay: catName,
                catID: this.newTrouperRow().catID()
            };

            //console.log("toAdd", toAdd);
            this.trouperInfo.push(toAdd);
        }

        addPerformance() {
            var name = $("#selectVenues option:selected").text();
            var typeName = $("#inEventCategory option:selected").text();

            var toAdd: IEventInfo = {
                venueID: this.newPerformance().venueId(),
                venueName: name,
                type: typeName,
                typeID:this.newPerformance().typeId(),
                when: this.newPerformance().when()
            };

            console.log("toAdd", toAdd);
            this.performanceInfo.push(toAdd);
        }

        reset() {
            this.eventTitle("");
            this.eventSlug("");
            this.active(false);

            this.artfullyId("");
            this.preEventPrice("");
            this.doorPrice("");
            this.eventNotes("");
        }

        load(data: IEventOverview) {
            if (!data)
                return;

            this.eventTitle(data.event.Title);
            this.eventSlug(data.event.Slug);
            this.active(data.event.CurrentSeason === '1');

            this.artfullyId(data.event.Artfully_ID);
            this.preEventPrice(data.event.EarlyTicketPrice);
            this.doorPrice(data.event.DoorTicketPrice);
            this.eventNotes(data.event.Notes);

            this.trouperInfo(data.trouperInfo);
        }

    }

    interface IEventOverview {
        event: IEvent;
        trouperInfo: ITrouperInfo[];
        eventInfo: IEventInfo[];
        adminInfo: any[];
    }

    interface IEvent {
        ID: number;
        Slug: string;
        Title: string;
        EarlyTicketPrice: string;
        DoorTicketPrice: string;
        Notes: string;
        Company_ID: string;
        CreatedBy_ID: string;
        EditedBy_ID: string;
        Artfully_ID: string;
        CurrentSeason: string;
        PublishCast: string;
    }

    interface ITrouperInfo {
        trouperID: string;
        fullName: string;
        role: string;
        catID: string;
        catDisplay: string;
    }

    interface IEventInfo {
        venueID: string;
        venueName: string;
        when: string;
        type: string;
        typeID: string;
    }
}