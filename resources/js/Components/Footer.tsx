import { MapPin, Phone, Mail } from "lucide-react";

const Footer = () => {
  return (
    <footer id="contact" className="bg-[#eff4f8] text-foreground">
      <div className="container mx-auto px-4 py-14">
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
          <div>
            <h3 className="font-bold text-lg mb-3">Dr. Sitek Ferryanto</h3>
            <p className="text-sm opacity-70 leading-relaxed mb-4">
              Dokter umum dengan pengalaman lebih dari 22 tahun memberikan pelayanan kesehatan yang ramah, terjangkau, dan profesional.
            </p>
            <p className="text-sm font-semibold">Follow Us</p>
          </div>

          <div>
            <h4 className="font-bold mb-3">Quick Links</h4>
            <ul className="space-y-2 text-sm opacity-70">
              {["Home", "About Us", "Services", "Contact"].map((l) => (
                <li key={l}><a href={`#${l.toLowerCase().replace(" ", "")}`} className="hover:opacity-100 transition-opacity">{l}</a></li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="font-bold mb-3">Our Services</h4>
            <ul className="space-y-2 text-sm opacity-70">
              {["General Consultation", "Medical Check-up", "Child Healthcare", "Senior Care", "Prescription Medicine"].map((s) => (
                <li key={s}>{s}</li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="font-bold mb-3">Contact Us</h4>
            <ul className="space-y-3 text-sm opacity-70">
              <li className="flex items-start gap-2">
                <MapPin className="w-4 h-4 flex-shrink-0 mt-0.5" />
                3FJH+5WR, Jl. Kapitan Juhoi, Kapuas Kanan Hulu, Kec. Sintang, Kabupaten Sintang, Kalimantan Barat 78613
              </li>
              <li className="flex items-center gap-2">
                <Phone className="w-4 h-4 flex-shrink-0" />
                +62 896-1394-3395
              </li>
              <li className="flex items-center gap-2">
                <Mail className="w-4 h-4 flex-shrink-0" />
                praktekdrsitekferryanto@gmail.com
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div className="border-t border-background/10">
        <div className="container mx-auto px-4 py-4 flex flex-wrap justify-between text-xs opacity-50">
          <span>© 2026 HealthCare Plus. All rights reserved.</span>
          <span>Privacy Policy · Terms of Service</span>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
