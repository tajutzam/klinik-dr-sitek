
import ContactCTA from "@/components/services/ContactCTA";
import OperatingHours from "@/components/services/OperatingHours";
import OurServices from "@/components/services/OurService";
import ServiceFlow from "@/components/services/ServiceFlow";
import MainLayout from "@/layouts/AppLayout";

const Service = () => {
    return (
        <>
            <OurServices />
            <ServiceFlow />
            <OperatingHours />
            <ContactCTA />
        </>
    );
};

Service.layout = (page: React.ReactNode) => <MainLayout children={page} />;

export default Service;