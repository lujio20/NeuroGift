# NeuroGift 🧠

**An AI-powered personalized learning platform that reads your brain to teach you the way you actually learn.**

> Demo: [neurogift-demo.free.nf](https://neurogift-demo.free.nf)

---

## What is NeuroGift?

Most learning platforms give everyone the same content in the same format.  
NeuroGift is different — it reads your **brainwave signals** to discover how your brain actually processes information, then delivers educational content tailored to your intelligence type.

No questionnaires. No guessing. Just your brain.

---

## How It Works

```
EEG Device (NeuroGift-X1)
        ↓
Brainwave signal capture during 2-minute cognitive assessment
        ↓
AI Model 1 — Custom EEG Classifier
  → Random Forest trained on 2,803,517 EEG samples
  → Classifies user into one of 5 intelligence types
        ↓
Intelligence Type: Visual / Linguistic / Logical / Musical / Kinesthetic
        ↓
Personalized course feed (YouTube, Coursera, Satr)
  → Best For You: courses that match your pattern
  → Needs Transform: courses that don't — but we convert them
        ↓
AI Model 2 — Content Transformation Engine
  → Converts incompatible courses into your preferred format
  → Mindmaps, flashcards, keywords, visual summaries
  → [Planned: GPT/Gemini integration for dynamic transformation]
```

---

## The Two AI Models

### Model 1 — Custom EEG Intelligence Classifier
| Property | Value |
|---|---|
| Algorithm | Random Forest Classifier |
| Training data | 2,803,517 EEG samples |
| Classes | 5 intelligence types |
| Accuracy | 99.99% |
| File | `NeuroGift_Final_Model.pkl` |

### Model 2 — Content Transformation Engine
Transforms educational content into formats that match the user's learning style:
- **Concept Map** — key ideas and relationships
- **Keywords** — core terms extracted
- **Visual Outputs** — diagrams, mindmaps, flowcharts
- **Flashcards** — Q&A pairs for quick review

---

## Intelligence Types

| Type | Description |
|---|---|
| 🎨 Visual-Spatial | Learns through diagrams, maps, and visuals |
| 📖 Linguistic | Learns through reading, writing, and listening |
| 🔢 Logical-Mathematical | Learns through patterns, logic, and analysis |
| 🎵 Musical | Learns through rhythm, sound, and repetition |
| 🤸 Kinesthetic | Learns through hands-on practice and movement |

---

## Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML5 / CSS3 / JavaScript (inline) |
| Backend | PHP 8.x |
| Database | MySQL |
| AI Model | Python — scikit-learn (Random Forest) |
| EEG Data | `.edf` / `.mat` format |
| Hosting | Infinity Free |

---

## Repository Structure

```
NeuroGift/
├── 01_Research/          # EEG datasets, research references
├── 02_Design/            # Wireframes, user flow, UI assets
├── 03_Web_Prototype/     # Full web application (HTML + PHP)
│   ├── api/              # Backend PHP endpoints
│   └── assets/           # Images and media
├── 04_AI_Models/         # Trained model + documentation
├── 05_Documentation/     # Patent claims, architecture, business case
└── README.md
```

---

## Live Demo

**URL:** [neurogift-demo.free.nf](https://neurogift-demo.free.nf)

The demo simulates the full user journey:
1. Sign up / Login
2. EEG device connection (NeuroGift-X1 simulation)
3. 3-question cognitive assessment with live EEG display
4. AI intelligence classification
5. Personalized course feed
6. AI content transformation

---

## Team

| Name | Role | University |
|---|---|---|
| لجين أحمد عاتي — Lujain Ahmed Ati | Project Lead, Web Developer, Database Engineer | Jazan University |
| بيادر إبراهيم القاضي — Byadir Ibrahim Al-Qadi | UI/UX Designer (Figma) | Jazan University |
| جنا علي غروي — Jana Ali Ghurawi | UI/UX Designer (Figma) | Jazan University |
| يارا طاهر مباركي — Yara Taher Mubaraki | Data Analyst & AI Model Developer | King Khalid University |

**Supervisor:** د. أحمد جبريل عاتي — Dr. Ahmed Jabril Ati  
Doctorate in Administration and Educational Supervision

---

## Vision 2030 Alignment

NeuroGift directly supports Saudi Vision 2030:
- **Quality Education** — personalized learning improves outcomes
- **Digital Economy** — AI + EdTech built in Saudi Arabia  
- **Human Capital Development** — faster, more effective skill acquisition

---

## Patent Status

Novel invention filed under:  
**"System and Method for Biometric-Based Personalized Learning Content Delivery Using Real-Time EEG Intelligence Classification"**

See [`05_Documentation/Patent_Claims.md`](05_Documentation/Patent_Claims.md) for full claims.

---

*Built with ❤️ by Team NeuroGift — Saudi Arabia 🇸🇦*
