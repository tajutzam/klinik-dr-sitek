import { Stethoscope, HeartPulse, Baby, UserRound, Pill, Syringe } from "lucide-react";

const services = [
  { icon: Stethoscope, title: "Konsultasi Umum", desc: "Comprehensive medical consultation with experienced general practitioner for various health concerns." },
  { icon: HeartPulse, title: "Medical Check-up", desc: "Regular health screening and preventive care to maintain your overall wellness." },
  { icon: Baby, title: "Child Healthcare", desc: "Specialized pediatric care for infants, children, and adolescents with gentle approach." },
  { icon: UserRound, title: "Senior Care", desc: "Dedicated healthcare services for elderly patients with chronic condition management." },
  { icon: Pill, title: "Prescription Medicine", desc: "Quality generic and essential medicines from trusted pharmaceutical partners." },
  { icon: Syringe, title: "Basic Medical Procedures", desc: "Minor medical procedures and treatments performed with care and precision." },
];

const ServicesSection = () => {
  return (
    <section id="services" className="py-20">
      <div className="container mx-auto px-4 text-center">
        <h2 className="text-3xl font-bold text-foreground mb-3">Our Healthcare Services</h2>
        <p className="text-muted-foreground mb-12 max-w-lg mx-auto">
          Comprehensive medical services designed to meet your healthcare needs with professionalism and care.
        </p>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {services.map((s) => (
            <div key={s.title} className="bg-card border border-border rounded-xl p-6 text-left hover:shadow-lg hover:border-primary/30 transition-all group">
              <div className="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                <s.icon className="w-6 h-6 text-primary group-hover:text-primary-foreground transition-colors" />
              </div>
              <h3 className="font-bold text-foreground mb-2">{s.title}</h3>
              <p className="text-sm text-muted-foreground mb-4 leading-relaxed">{s.desc}</p>
              <a href="#contact" className="text-sm font-semibold text-primary hover:underline">
                Learn More →
              </a>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ServicesSection;
