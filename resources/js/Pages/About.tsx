import HeroSection from "@/components/HeroSection";
import ServicesSection from "@/components/ServicesSection";
import WhyChooseUs from "@/components/WhyChooseUs";
import BookingSection from "@/components/BookingSection";
import MainLayout from "@/layouts/AppLayout";
import AboutDoctor from "@/components/AboutDoctor";
import VisiAndMission from "@/components/VisiAndMission";
import Experience from "@/components/Experience";
import CoreValues from "@/components/CoreValues";
import OurAdvantages from "@/components/OurAdvantages";

const Index = () => {
    return (
        <>
            <AboutDoctor />
            <VisiAndMission />
            <Experience />
            <CoreValues />
            <OurAdvantages />
        </>
    );
};

Index.layout = (page: React.ReactNode) => <MainLayout children={page} />;

export default Index;