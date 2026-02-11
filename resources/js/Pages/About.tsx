import HeroSection from "@/Components/HeroSection";
import ServicesSection from "@/Components/ServicesSection";
import WhyChooseUs from "@/Components/WhyChooseUs";
import BookingSection from "@/Components/BookingSection";
import MainLayout from "@/layouts/AppLayout";
import AboutDoctor from "@/Components/AboutDoctor";
import VisiAndMission from "@/Components/VisiAndMission";
import Experience from "@/Components/Experience";
import CoreValues from "@/Components/CoreValues";
import OurAdvantages from "@/Components/OurAdvantages";

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