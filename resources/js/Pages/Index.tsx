import HeroSection from "@/Components/HeroSection";
import ServicesSection from "@/Components/ServicesSection";
import WhyChooseUs from "@/Components/WhyChooseUs";
import BookingSection from "@/Components/BookingSection";
import MainLayout from "@/layouts/AppLayout";

const Index = () => {
    return (
        <>
            <HeroSection />
            <ServicesSection />
            <WhyChooseUs />
            <BookingSection />
        </>
    );
};

Index.layout = (page: React.ReactNode) => <MainLayout children={page} />;

export default Index;