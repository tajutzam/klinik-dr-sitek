import { Award, Shield, Clock, Heart } from "lucide-react";

const reasons = [
  { icon: Award, title: "22+ Years Experience", desc: "Over two decades of trusted medical practice serving the Sintang community." },
  { icon: Shield, title: "Professional Care", desc: "Quality healthcare with modern facilities and trusted pharmaceutical partners." },
  { icon: Clock, title: "Easy Appointment", desc: "Simple and convenient booking system for your medical consultations." },
  { icon: Heart, title: "Personal Approach", desc: "Friendly, empathetic, and personalized care for every patient." },
];

const WhyChooseUs = () => {
  return (
    <section className="bg-section-alt py-20">
      <div className="container mx-auto px-4 text-center">
        <h2 className="text-3xl font-bold text-foreground mb-3">Why Choose Us</h2>
        <p className="text-muted-foreground mb-12 max-w-lg mx-auto">
          Committed to providing exceptional healthcare with a patient-first approach.
        </p>
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {reasons.map((r) => (
            <div key={r.title} className="bg-card border border-border rounded-xl p-6 hover:shadow-md transition-shadow">
              <div className="w-14 h-14 bg-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                <r.icon className="w-6 h-6 text-primary" />
              </div>
              <h3 className="font-bold text-foreground mb-2">{r.title}</h3>
              <p className="text-sm text-muted-foreground leading-relaxed">{r.desc}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default WhyChooseUs;
