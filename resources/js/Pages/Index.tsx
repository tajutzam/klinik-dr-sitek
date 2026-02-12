import HeroSection from "@/components/home/HeroSection";
import ServicesSection from "@/components/home/ServicesSection";
import WhyChooseUs from "@/components/home/WhyChooseUs";
import BookingSection from "@/components/home/BookingSection";
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