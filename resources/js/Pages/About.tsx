import HeroSection from "@/components/home/HeroSection";
import ServicesSection from "@/components/home/ServicesSection";
import WhyChooseUs from "@/components/home/WhyChooseUs";
import BookingSection from "@/components/home/BookingSection";
import MainLayout from "@/layouts/AppLayout";
import AboutDoctor from "@/components/abouts/AboutDoctor";
import VisiAndMission from "@/components/abouts/VisiAndMission";
import Experience from "@/components/abouts/Experience";
import CoreValues from "@/components/abouts/CoreValues";
import OurAdvantages from "@/components/abouts/OurAdvantages";

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