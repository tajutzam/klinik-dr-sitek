import HeroSection from "@/components/HeroSection";
import ServicesSection from "@/components/ServicesSection";
import WhyChooseUs from "@/components/WhyChooseUs";
import BookingSection from "@/components/BookingSection";
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