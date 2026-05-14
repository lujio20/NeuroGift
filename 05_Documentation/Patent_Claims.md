# NeuroGift — Patent Claims Document

> ⚠️ هذا الملف لأغراض التوثيق الأولي وحماية الفكرة. لا يُعد وثيقة قانونية رسمية.
> للتقديم الفعلي على براءة اختراع، يجب مراجعة محامٍ متخصص في الملكية الفكرية.

---

## Title of Invention

**System and Method for Biometric-Based Personalized Learning Content Delivery Using Real-Time EEG Intelligence Classification**

---

## Field of Invention

The present invention relates to educational technology, and more specifically to a system and method that uses electroencephalography (EEG) signals to classify a user's dominant intelligence type and dynamically personalize digital educational content accordingly.

---

## Background

Current personalized learning systems rely on:
- Subjective questionnaires (Myers-Briggs, VARK, etc.)
- Historical behavioral data and clickstream analysis
- Manual user preference configuration

None of these methods capture the **neurological basis** of individual learning differences. They are slow to adapt, easily gamed, and fundamentally imprecise.

The present invention addresses this gap by directly measuring brain activity to determine how a user's neural architecture processes information, then using this biological profile to select and adapt educational content in real time.

---

## Summary of Invention

The invention provides a three-component pipeline:

1. **Neural Signal Acquisition** — A non-invasive EEG device captures brainwave data from a user during a brief standardized cognitive task.

2. **AI-Based Intelligence Classification** — A trained machine learning classifier analyzes EEG frequency-band features to categorize the user into one of N intelligence types (in the current embodiment: Visual-Spatial, Linguistic, Logical-Mathematical, Musical, Kinesthetic).

3. **Adaptive Content Engine** — A software platform uses the classified intelligence type to:
   - Rank and surface compatible educational content from multiple platforms
   - Transform incompatible content into formats optimized for the user's learning modality

---

## Independent Claims

### Claim 1
A computer-implemented method for personalizing educational content delivery, comprising:
- receiving, from a wearable EEG sensor, raw brainwave signals captured during a standardized cognitive assessment task;
- extracting frequency-band features from said signals, including at least alpha, beta, theta, and gamma band power measurements;
- inputting said features into a trained classification model to generate an intelligence type label and associated confidence score;
- querying an educational content database to retrieve content items ranked by compatibility with said intelligence type label;
- presenting to the user a ranked list of compatible content alongside a subset of incompatible content marked for transformation.

### Claim 2
The method of Claim 1, further comprising:
- upon user selection of a marked incompatible content item, generating a transformed version of said content adapted to the user's classified intelligence type, wherein the transformation includes at least one of: concept mapping, keyword extraction, visual summary generation, or flashcard creation.

### Claim 3
The method of Claim 1, wherein the classification model is a Random Forest classifier trained on labeled EEG frequency-band data from subjects performing standardized cognitive tasks, with class weights adjusted to compensate for class imbalance across intelligence type categories.

### Claim 4
A system for biometric-driven learning personalization, comprising:
- a wearable EEG sensing device configured to capture multi-channel brainwave signals;
- a signal processing module configured to extract frequency-domain features from said signals;
- a machine learning classification engine configured to map said features to an intelligence type;
- a content recommendation engine configured to retrieve and rank educational content based on said intelligence type;
- a content transformation engine configured to reformat educational content into modality-specific formats upon user request.

### Claim 5
The system of Claim 4, wherein the content recommendation engine integrates with multiple third-party educational platforms simultaneously, presenting a unified, intelligence-ranked content feed across all integrated platforms.

---

## Key Novelty Points

| Novel Element | Prior Art Gap |
|---|---|
| EEG → intelligence classification → content ranking, in a single automated pipeline | No prior system connects these three stages without human intervention |
| Content transformation (not removal) for incompatible learning styles | Prior systems filter out incompatible content; NeuroGift transforms it |
| Cross-platform unified intelligence-ranked feed | Prior recommenders are platform-specific |
| Class-balanced EEG classifier for 5-type intelligence categorization | Existing EEG classifiers focus on medical/emotional states, not educational intelligence types |

---

## Disclosure Date

First functional prototype demonstrated: February 2025
Public demo URL: neurogift-demo.free.nf
Repository: github.com/lujio20/NeuroGift (private)

---

## Team & Supervision

### Project Leader
**Lujain Ahmed Ati — لجين أحمد عاتي**
- Role: Project Lead, Web Developer, Database Engineer
- - University: Jazan University
 
  - ### Team Members
 
  - | Name | Role | University |
  - |---|---|---|
  - | Byadir Ibrahim Al-Qadi — بيادر إبراهيم القاضي | UI/UX Designer (Figma) | Jazan University |
  - | Jana Ali Ghurawi — جنا علي غروي | UI/UX Designer (Figma) | Jazan University |
  - | Yara Taher Mubaraki — يارا طاهر مباركي | Data Analyst & AI Model Developer | King Khalid University |
 
  - ### Project Supervisor
  - **Dr. Ahmed Jabril Ati — د. أحمد جبريل عاتي**
  - - Specialization: Administration and Educational Supervision
    - - Qualification: Doctorate in Administration and Educational Supervision
     
      - ---

      ## Institutions
      - Jazan University — جامعة جازان
      - - King Khalid University — جامعة الملك خالد
       
        - **Country:** Saudi Arabia
